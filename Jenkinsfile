node {
  git 'https://github.com/puppetlabs/rgbank'

  puppet.credentials 'pe-access-token'
  def hostaddress = InetAddress.localHost.hostAddress
  def version = env.BUILD_ID

  // ARTIFACTORY SETUP //
  def artifactoryServer = Artifactory.server 'artifactory'
  def uploadSpec = """{
    "files": [
      {
        "pattern": "rgbank-build-${version}.tar.gz",
        "target": "rgbank-web"
      }
    ]
  }"""
  def downloadSpec = """{
    "files": [
      {
        "pattern": "rgbank-web",
        "target": "/opt/rgbank"
      }
    ]
  }"""
  def buildInfo1 = artifactoryServer.upload spec: uploadSpec
  def buildInfo2 = artifactoryServer.download spec: downloadSpec
  buildInfo1.append buildInfo2

  // BUILD ENVIRONMENT SETUP //
  // This uses the Dockerfile in this repo to spin up a testing agent
  // with all the system reqs in place
  docker.build("rgbank-build-env:${version}")

  // STAGES //
  stage('Lint and unit tests') {
    docker.image("rgbank-build-env:${version}").inside {
			withEnv(['PATH+EXTRA=/usr/local/bin']) {
				sh 'bundle install'
				sh 'bundle exec rspec spec/'
			}
    }
  }

  stage('Build and package') {
    docker.image("rgbank-build-env:${version}").inside {
			sh 'tar -czf rgbank-build-$BUILD_ID.tar.gz -C src .'
    }

    archive "rgbank-build-${version}.tar.gz"
    archive "rgbank.sql"
    artifactoryServer.publishBuildInfo buildInfo1
  }

  stage('Deployment Test') {
    puppet.hiera scope: 'beaker', key: 'rgbank-build-version', value: version
    // build job: 'puppetlabs-rgbank-spec', parameters: [string(name: 'COMMIT', value: env.rgbank_module_ver)]
  }

  stage('Deploy to dev'){
    puppet.hiera scope: 'dev', key: 'rgbank-build-version', value: version
    puppet.codeDeploy 'dev'
    puppet.job 'dev', application: 'Rgbank'
  }

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
