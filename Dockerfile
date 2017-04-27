FROM ruby:2.3.1

RUN apt-get update && \
    wget http://apt.puppetlabs.com/puppetlabs-release-pc1-jessie.deb && \
    dpkg -i puppetlabs-release-pc1-jessie.deb && \
    apt-get update && \
    apt-get install puppet

RUN puppet module install puppetlabs-aws
