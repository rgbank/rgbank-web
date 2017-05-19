node {

  puppet.credentials 'pe-access-token'
  def hostaddress = InetAddress.localHost.hostAddress
  def version = env.BUILD_ID
  def puppetMasterAdress = org.jenkinsci.plugins.puppetenterprise.models.PuppetEnterpriseConfig.getPuppetMasterUrl()

  stage('Prepare build environment'){
    checkout scm
    docker.build("rgbank-build-env:latest")
  }

  if(env.BRANCH_NAME != "master") {
    stage('Lint and unit tests') {
      docker.image("rgbank-build-env:latest").inside {
        //sh "bundle install"
        //sh '/usr/local/bin/bundle exec rspec spec/'
      }
    }

    stage('Build and package') {
      artifactoryServer = Artifactory.server 'artifactory'

      buildUploadSpec = """{
        "files": [ {
          "pattern": "rgbank-build-${version}.tar.gz",
          "target": "rgbank-web"
        } ]
      }"""

      devSQLUploadSpec = """{
        "files": [ {
          "pattern": "rgbank.sql",
          "target": "rgbank-web"
        } ]
      }"""

      docker.image("rgbank-build-env:latest").inside {
        sh "/usr/bin/tar -czf rgbank-build-${version}.tar.gz -C src ."
      }

      archive "rgbank-build-${version}.tar.gz"
      archive "rgbank.sql"
      artifactoryServer.upload spec: buildUploadSpec
      artifactoryServer.upload spec: devSQLUploadSpec
    }

    stage("Deploy to dev") {
      puppet.hiera scope: 'dev', key: 'rgbank-build-version', value: version
      puppet.job 'production', application: "Rgbank[dev]"
    }
  }

  if(env.BRANCH_NAME == "master") {

    stage('Promote to staging') {
      input "Ready to deploy to staging?"
      puppet.hiera scope: 'rgbank-staging', key: 'rgbank-build-version', value: version
      puppet.codeDeploy 'staging'
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
      puppet.hiera scope: 'rgbank-production', key: 'rgbank-build-version', value: version
      puppet.codeDeploy 'production'
      puppet.job 'production', noop: true, application: 'Rgbank[production]'
    }
  
    stage('Deploy to production') {
      input "Ready to deploy to production?"
      puppet.job 'production', concurrency: 40, application: 'Rgbank[production]'
    }
  }
}
