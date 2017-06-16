FROM centos:7

RUN rpm -Uvh https://yum.puppetlabs.com/puppetlabs-release-pc1-el-7.noarch.rpm && \
    yum makecache && \
    yum install -y puppet-agent

RUN /opt/puppetlabs/bin/puppet module install puppetlabs-aws && \
    /opt/puppetlabs/bin/puppet module install puppetlabs/image_build && \
    /opt/puppetlabs/puppet/bin/gem install aws-sdk-core aws-sdk-resources retries

COPY rgbank-aws-dev-env.pp /
