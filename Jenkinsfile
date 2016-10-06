node {
  git 'https://github.com/puppetlabs/rgbank'

  stage 'Lint and unit tests'
  withEnv(['PATH=/usr/local/bin:$PATH']) {
    sh 'bundle install'
    sh 'bundle exec rspec spec/'
  }

  stage 'Build and package'
  def version = env.BUILD_ID
  sh 'tar -czf rgbank-build-$BUILD_ID.tar.gz -C src .'
  archive "rgbank-build-${version}.tar.gz"
  archive "rgbank.sql"
  step([$class: 'CopyArtifact', filter: "rgbank-build-${version}.tar.gz", fingerprintArtifacts: true, projectName: env.JOB_NAME, selector: [$class: 'SpecificBuildSelector', buildNumber: env.BUILD_ID], target: '/var/www/html/builds/rgbank'])
  step([$class: 'CopyArtifact', filter: "rgbank.sql", fingerprintArtifacts: true, projectName: env.JOB_NAME, selector: [$class: 'SpecificBuildSelector', buildNumber: env.BUILD_ID], target: '/var/www/html/builds/rgbank'])

  def hostaddress = InetAddress.localHost.hostAddress

  stage 'Deployment Test'
  puppet.hiera scope: 'beaker', key: 'rgbank-build-version', value: version
  puppet.hiera scope: 'beaker', key: 'rgbank-build-path', value: "http://" + hostaddress + "/builds/rgbank/rgbank-build-${version}.tar.gz"
  puppet.hiera scope: 'beaker', key: 'rgbank-mock-sql-path', value: "http://" + hostaddress + "/builds/rgbank/rgbank.sql"
  build job: 'puppetlabs-rgbank-spec', parameters: [string(name: 'COMMIT', value: env.rgbank_module_ver)]

  puppet.credentials 'pe-access-token'

  stage 'Deploy to dev'
  puppet.hiera scope: 'dev', key: 'rgbank-build-version', value: version
  puppet.hiera scope: 'dev', key: 'rgbank-build-path', value: "http://" + hostaddress + "/builds/rgbank/rgbank-build-${version}.tar.gz"
  puppet.hiera scope: 'dev', key: 'rgbank-mock-sql-path', value: "http://" + hostaddress + "/builds/rgbank/rgbank.sql"
  puppet.codeDeploy 'dev'
  puppet.job 'dev', target: 'Rgbank'

  stage 'Promote to staging'
  input "Ready to deploy to staging?"
  puppet.hiera scope: 'staging', key: 'rgbank-build-version', value: version
  puppet.hiera scope: 'staging', key: 'rgbank-build-path', value: "http://" + hostaddress + "/builds/rgbank/rgbank-build-${version}.tar.gz"
  puppet.hiera scope: 'staging', key: 'rgbank-mock-sql-path', value: "http://" + hostaddress + "/builds/rgbank/rgbank.sql"
  puppet.codeDeploy 'staging'
  puppet.job 'staging', target: 'Rgbank'

  stage 'Staging acceptance tests'
  // Run acceptance tests here to make sure no applications are broken

  stage 'Promote to production'
  input "Ready to test deploy to production?"

  stage 'Noop production run'
  puppet.hiera scope: 'production', key: 'rgbank-build-version', value: version
  puppet.hiera scope: 'production', key: 'rgbank-build-path', value: "http://" + hostaddress + "/builds/rgbank/rgbank-build-${version}.tar.gz"
  puppet.hiera scope: 'production', key: 'rgbank-mock-sql-path', value: "http://" + hostaddress + "/builds/rgbank/rgbank.sql"
  puppet.codeDeploy 'production'
  puppet.job 'production', noop: true, target: 'Rgbank'


  stage 'Deploy to production'
  input "Ready to deploy to production?"
  puppet.job 'production', concurrency: 40, target: 'Rgbank'
}
