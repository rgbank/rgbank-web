node {
  git 'https://github.com/puppetlabs-pmmteam/rgbank'

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

  stage 'Deploy to dev'
  puppetHiera path: 'dev', key: 'rgbank-build-version', value: version
  puppetHiera path: 'dev', key: 'rgbank-build-path', value: "http://10-32-173-237.rfc1918.puppetlabs.net/builds/rgbank/rgbank-build-${version}.tar.gz"
  puppetHiera path: 'dev', key: 'rgbank-mock-sql-path', value: "http://10-32-173-237.rfc1918.puppetlabs.net/builds/rgbank/rgbank.sql"
  puppetCode environment: 'dev', credentialsId: 'pe-access-token'
  puppetJob environment: 'dev', target: 'Rgbank', credentialsId: 'pe-access-token'

  stage 'Promote to staging'
  input "Ready to deploy to staging?"
  puppetHiera path: 'staging', key: 'rgbank-build-version', value: version
  puppetHiera path: 'staging', key: 'rgbank-build-path', value: "http://10-32-173-237.rfc1918.puppetlabs.net/builds/rgbank/rgbank-build-${version}.tar.gz"
  puppetHiera path: 'staging', key: 'rgbank-mock-sql-path', value: "http://10-32-173-237.rfc1918.puppetlabs.net/builds/rgbank/rgbank.sql"
  puppetCode environment: 'staging', credentialsId: 'pe-access-token'
  puppetJob environment: 'staging', target: 'Rgbank', credentialsId: 'pe-access-token'

  stage 'Staging acceptance tests'
  // Run acceptance tests here to make sure no applications are broken

  stage 'Promote to production'
  input "Ready to test deploy to production?"

  stage 'Noop production run'
  puppetHiera path: 'production', key: 'rgbank-build-version', value: version
  puppetHiera path: 'production', key: 'rgbank-build-path', value: "http://10-32-173-237.rfc1918.puppetlabs.net/builds/rgbank/rgbank-build-${version}.tar.gz"
  puppetHiera path: 'production', key: 'rgbank-mock-sql-path', value: "http://10-32-173-237.rfc1918.puppetlabs.net/builds/rgbank/rgbank.sql"
  puppetCode environment: 'production', credentialsId: 'pe-access-token'
  puppetJob environment: 'production', noop: true, target: 'Rgbank', credentialsId: 'pe-access-token'


  stage 'Deploy to production'
  input "Ready to deploy to production?"
  puppetJob environment: 'production', concurrency: 40, target: 'Rgbank', credentialsId: 'pe-access-token'
}
