@NonCPS
def get_puppet_instance_count(String reportFile) {
  File f = new File(reportFile)
  def jsonSlurper = new groovy.json.JsonSlurperClassic()
  def jsonText = f.getText() + ']' //workaround a bug
  count = 0
  json = jsonSlurper.parseText( jsonText )

  for (entry in json) {
    if (entry.source =~ /.*Ec2_instance\[.*$/ && entry.message =~ /.*ensure changed from absent to running.*/) {
      count = count + 1
    }
  }

  return count
}

@NonCPS
def node_count() {
  results = puppet.query("inventory[certname] { facts.trusted.extensions.pp_application = \"Rgbank[${env.BRANCH_NAME}]\" and facts.trusted.extensions.pp_project = \"${env.BUILD_NUMBER}\" }")
  return results.size()
}

node {

  puppet.credentials 'pe-access-token'
  version = ''
  puppetMasterAddress = org.jenkinsci.plugins.puppetenterprise.models.PuppetEnterpriseConfig.getPuppetMasterUrl()
  puppetMasterIP = "getent ahostsv4 | grep ${puppetMasterAddress} | awk '{ print \$1 }'".execute().text

  stage('Prepare build environment'){
    checkout scm
    version = sh(returnStdout: true, script: 'git rev-parse HEAD').trim().take(6)
    docker.build("rgbank-build-env:latest")
  }

  stage('Lint and unit tests') {
    docker.image("rgbank-build-env:latest").inside {
      //sh "bundle install"
      //sh '/usr/local/bin/bundle exec rspec spec/'
    }
  }

  if (env.BRANCH_NAME != "master") {
    stage('Build development environment') {
      docker.image("rgbank-build-env:latest").inside('--user 0:0') {
        withCredentials([
          string(credentialsId: 'aws-key-id', variable: 'AWS_KEY_ID'),
          string(credentialsId: 'aws-access-key', variable: 'AWS_ACCESS_KEY')
        ]) {
          withEnv([
            "FACTER_puppet_master_address=${puppetMasterAddress}",
            "FACTER_puppet_master_ip=${puppetMasterIP}",
            "FACTER_branch=${env.BRANCH_NAME}",
            "FACTER_build=${env.BUILD_NUMBER}",
            "AWS_ACCESS_KEY_ID=${AWS_KEY_ID}",
            "AWS_SECRET_ACCESS_KEY=${AWS_ACCESS_KEY}"
          ]) {
            sh "/opt/puppetlabs/bin/puppet apply /rgbank-aws-dev-env.pp --logdest ${WORKSPACE}/puppetrun.json"
          }
        }
      }

      def instance_count = get_puppet_instance_count("${WORKSPACE}/puppetrun.json")

      while ( node_count().toInteger() != instance_count().toInteger() ) {
        sleep 5
      }
      println "Running puppet job"

      puppet.job 'production', application: Rgbank[env.BRANCH_NAME]
    }
  } else {

    stage('Build and package') {
      artifactoryServer = Artifactory.server 'artifactory'

      buildUploadSpec = """{
        "files": [ {
          "pattern": "rgbank-build-#version#.tar.gz",
          "target": "rgbank-web"
        } ]
      }""".replace("#version#",version)

      devSQLUploadSpec = """{
        "files": [ {
          "pattern": "rgbank.sql",
          "target": "rgbank-web"
        } ]
      }"""

      docker.image("rgbank-build-env:latest").inside {
        sh("/usr/bin/tar -czf rgbank-build-${version}.tar.gz -C src .")
      }

      archive "rgbank-build-${version}.tar.gz"
      archive "rgbank.sql"
      artifactoryServer.upload spec: buildUploadSpec
      artifactoryServer.upload spec: devSQLUploadSpec
    }

    stage('Promote to staging') {
      input "Ready to deploy to staging?"
      puppet.hiera scope: 'staging', key: 'rgbank-build-version', value: version
      puppet.hiera scope: 'staging', key: 'rgbank-build-source-type', value: 'artifactory'
      puppet.job 'production', application: 'Rgbank[staging]'
    }
  
    stage('Staging acceptance tests') {
      docker.image("rgbank-build-env:latest").inside {
        sh 'echo success'
      }
    }
  
    stage('Promote to production') {
      input "Ready to test deploy to production?"
    }
  
    stage('Noop production run') {
      puppet.hiera scope: 'production', key: 'rgbank-build-version', value: version
      puppet.hiera scope: 'production', key: 'rgbank-build-source-type', value: 'artifactory'
      puppet.job 'production', noop: true, application: 'Rgbank[production]'
    }
  
    stage('Deploy to production') {
      input "Ready to deploy to production?"
      puppet.job 'production', concurrency: 40, application: 'Rgbank[production]'
    }
  }
}
/* vim: set filetype=groovy */
