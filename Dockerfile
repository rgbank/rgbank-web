FROM ruby:2.3.1

RUN apt-get update && \
    rpm -i http://yum.puppetlabs.com/puppetlabs-release-pc1-el-7.noarch.rpm && \
    apt-get update && \
    apt-get install puppet

RUN puppet module install puppetlabs-aws
