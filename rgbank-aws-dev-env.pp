$epp_script = @("EPP"/)
#/bin/bash
curl -k https://<%= \$master_address %>:8140/packages/current/install.bash | sudo bash -s extension_requests:pp_role=<%= \$pp_role %> extension_requests:pp_appenv=<%= \$pp_appenv %>
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
  subnet            => 'rgbank-subnet',
  security_groups   => ['rgbank-vpn','rgbank-ssh'],
  tags              => {
    puppet_provisioned => 'true',
    development_branch => $::branch,
  },
}

ec2_vpc { 'rgbank-development':
  ensure => present,
  region => 'us-east-1',
  cidr_block => '10.0.0.0/24',
  tags => { 'disposable' => 'true' },
}

ec2_vpc_internet_gateway { 'rgbank-igateway':
  ensure => present,
  region => 'us-east-1',
  vpc    => 'rgbank-development',
}

ec2_vpc_subnet { 'rgbank-subnet':
  ensure                  => present,
  region                  => 'us-east-1',
  cidr_block              => '10.0.0.0/24',
  availability_zone       => 'us-east-1c',
  map_public_ip_on_launch => 'true',
  vpc                     => 'rgbank-development',
  tags                    => {
    tag_name => 'value',
  },
}

ec2_securitygroup { 'rgbank-ssh':
  ensure      => present,
  region      => 'us-east-1',
  vpc         => 'rgbank-development',
  description => "SSH access",
  ingress     => [{
    protocol  => 'tcp',
    port      => 22,
    cidr      => '0.0.0.0/0',
  }],
}

ec2_securitygroup { 'rgbank-vpn':
  ensure      => present,
  region      => 'us-east-1',
  vpc         => 'rgbank-development',
  description => 'OpenVPN access',
  ingress     => [{
    protocol  => 'udp',
    port      => 1194,
    cidr      => '0.0.0.0/0',
  },{
    protocol  => 'tcp',
    port      => 443,
    cidr      => '0.0.0.0/0',
  }],
  tags        => {
    vpn => 'true',
  },
}

ec2_instance { "rgbank-${::branch}-database":
  user_data => inline_epp( $epp_script, {
    'master_address' => $::puppet_master_address,
    'pp_role'        => 'rgbank-database',
    'pp_appenv'      => $::branch,
  }),
}

ec2_instance { "rgbank-${::branch}-web":
  user_data => inline_epp( $epp_script, {
    'master_address' => $::puppet_master_address,
    'pp_role'        => 'rgbank-web',
    'pp_appenv'      => $::branch,
  }),
}

ec2_instance { "rgbank-${::branch}-loadbalancer":
  user_data => inline_epp( $epp_script, {
    'master_address' => $::puppet_master_address,
    'pp_role'        => 'rgbank-lb',
    'pp_appenv'      => $::branch,
  }),
}
