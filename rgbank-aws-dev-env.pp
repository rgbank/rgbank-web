$epp_script = @("EPP"/)
#!/bin/bash

echo "<%= \$master_ip %> <%= \$master_address %> puppet" >> /etc/hosts

/bin/yum makeache

curl -k https://puppet:8140/packages/current/install.bash | bash -s \
  extension_requests:pp_role=<%= \$role %> \
  extension_requests:pp_datacenter=AWS \
  extension_requests:pp_application=<%= \$application%> \
  extension_requests:pp_environment=<%= \$environment%> \
  extension_requests:pp_apptier=<%= \$apptier%> \
  extension_requests:pp_project=<%= \$build_id %>

#Make absolutely sure we can run the puppet agent from scratch
/bin/ps aux | grep "puppet agent" | grep -v grep | awk '{ print $2 }' | xargs kill
/opt/puppetlabs/bin/puppet agent -t
| EPP

if ($::destroy) {
  $ensure = absent
} else {
  $ensure = present
}

Ec2_instance {
  ensure            => $ensure,
  region            => 'us-east-1',
  image_id          => 'ami-6b32627c',
  instance_type     => 't2.small',
  key_name          => 'ccaum',
  availability_zone => 'us-east-1c',
  subnet            => 'ara-subnet',
  security_groups   => ['default','ssh'],
  tags              => {
    development_branch => $::branch,
    development_app    => "RG Bank",
    provisioner        => "puppet",
    department         => "Product Marketing",
    project            => "ARA demo",
    owner              => "Carl Caum",
  },
}

ec2_instance { "rgbank-development-${::branch}.aws.puppet.vm":
  instance_type   => 't2.small',
  security_groups => ['rgbank-app','mysql','ssh'],
  user_data       => inline_epp( $epp_script, {
    'master_address' => $::puppet_master_address,
    'master_ip'      => $::puppet_master_ip,
    'role'           => 'rgbank-development',
    'application'    => "Rgbank[${::branch}]",
    'environment'    => $::branch,
    'apptier'        => '[Rgbank::Db,Rgbank::Web]',
    'build_id'       => $::build,
  }),
}
