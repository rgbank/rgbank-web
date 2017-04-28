FROM centos:7

RUN rpm -Uvh https://yum.puppetlabs.com/puppetlabs-release-pc1-el-7.noarch.rpm && \
    yum makecache && \
    yum install -y puppet-agent

RUN /opt/puppetlabs/bin/puppet module install puppetlabs-aws
