node {
  git 'https://github.com/puppetlabs-pmmteam/rgbank'

  stage 'Lint and unit tests'
  withEnv(['PATH=/usr/local/bin:$PATH']) {
    sh 'bundle install'
    sh 'bundle exec rspec spec/'
  }

  stage 'Build and package'
  def version = env.GIT_COMMIT
  sh "tar -czf rgbank-build-${version}.tar.gz src/"
  archive "rgbank-build-${version}.tar.gz"

  stage 'Deploy to dev'
  puppetHiera path: 'development', key: 'rgbank-build-version', value: version
  puppetJob environment: 'dev', target: 'Rgbank::Web', credentialsId: 'pe-access-token'

  stage 'Promote to staging'
  input "Ready to deploy to staging?"
  puppetHiera path: 'staging', key: 'rgbank-build-version', value: version
  puppetJob environment: 'staging', target: 'Rgbank::Web', credentialsId: 'pe-access-token'

  stage 'Staging acceptance tests'
  // Run acceptance tests here to make sure no applications are broken

  stage 'Promote to production'
  input "Ready to test deploy to production?"

  stage 'Noop production run'
  puppetHiera path: 'production', key: 'rgbank-build-version', value: version
  puppetJob environment: 'production', noop: true, target: 'Rgbank::Web', credentialsId: 'pe-access-token'


  stage 'Deploy to production'
  input "Ready to deploy to production?"
  puppetJob environment: 'production', concurrency: 40, target: 'Rgbank::Web', credentialsId: 'pe-access-token'
}
