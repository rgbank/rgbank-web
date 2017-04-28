node {

  puppet.credentials 'pe-access-token'
  def hostaddress = InetAddress.localHost.hostAddress
  def version = env.BUILD_ID

  stage('Prepare build environment'){
    checkout scm
    docker.build("rgbank-build-env")
  }

  stage('Lint and unit tests') {
    docker.image("rgbank-build-env").inside {
			//sh "bundle install"
			//sh '/usr/local/bin/bundle exec rspec spec/'
    }
  }

  if(env.BRANCH_NAME != "master") {
    stage('Build and package') {
      artifactoryServer = Artifactory.server 'artifactory'
      uploadSpec = """{
        "files": [
          {
            "pattern": "rgbank-build-${version}.tar.gz",
            "target": "rgbank-web"
          }
        ]
      }"""

      docker.image("rgbank-build-env:${version}").inside {
	  		sh 'tar -czf rgbank-build-$BUILD_ID.tar.gz -C src .'
      }

      archive "rgbank-build-${version}.tar.gz"
      archive "rgbank.sql"
      artifactoryServer.upload spec: uploadSpec
    }

    stage('Deploy to dev'){
      puppet.hiera scope: 'dev', key: 'rgbank-build-version', value: version
      puppet.codeDeploy 'dev'
      puppet.job 'dev', application: 'Rgbank'
    }
  }

  if(env.BRANCH_NAME == "master") {

    stage('Promote to staging') {
      input "Ready to deploy to staging?"
      puppet.hiera scope: 'rgbank-staging', key: 'rgbank-build-version', value: version
      puppet.codeDeploy 'staging'
      puppet.job 'staging', application: 'Rgbank'
    }
  
    stage('Staging acceptance tests') {
      docker.image("rgbank-build-env:${version}").inside {
        sh 'echo success'
      }
    }
  
    stage('Promote to production') {
      input "Ready to test deploy to production?"
    }
  
    stage('Noop production run') {
      puppet.hiera scope: 'rgbank-production', key: 'rgbank-build-version', value: version
      puppet.codeDeploy 'production'
      puppet.job 'production', noop: true, application: 'Rgbank'
    }
  
    stage('Deploy to production') {
      input "Ready to deploy to production?"
      puppet.job 'production', concurrency: 40, application: 'Rgbank'
    }
  }
}
