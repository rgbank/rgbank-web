$epp_script = @("EPP"/)
#/bin/bash
echo "52.54.213.229 master.inf.puppet.vm puppet ip-10-0-0-148" >> /etc/hosts
curl -k https://<%= \$master_address %>:8140/packages/current/install.bash | bash -s  extension_requests:pp_role=<%= \$role %> extension_requests:pp_application=<%= \$application%> extension_requests:pp_environment=<%= \$environment%> extension_requests:pp_apptier=<%= \$apptier%>
/usr/local/bin/puppet agent -t
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
    #development_branch => $::branch,
    department         => "Product Marketing",
    project            => "ARA demo",
    owner              => "Carl Caum",
  },
}


ec2_instance { "rgbank-development-${::branch}.aws.puppet.vm":
  instance_type   => 't2.small',
  security_groups => ['http','ssh'],
  user_data       => inline_epp( $epp_script, {
    'master_address' => 'ip-10-0-0-148',
    'role'           => 'loadbalancer',
    'application'    => "Rgbank[${::branch}]",
    'environment'    => $::branch,
    'apptier'        => '[Rgbank::Db,Rgbank::Web]',
  }),
}
