FROM ruby:2.3.1

RUN apt-get update && \
    wget http://apt.puppetlabs.com/puppetlabs-release-jessie.deb && \
    dpkg -i puppetlabs-release-jessie.deb && \
    apt-get update && \
    apt-get -y install puppet-agent

RUN puppet module install puppetlabs-aws
