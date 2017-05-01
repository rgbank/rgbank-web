$epp_script = @("EPP"/)
#/bin/bash
curl -k https://<%= \$master_address %>:8140/packages/current/install.bash | sudo bash -s extension_requests:pp_role=<%= \$pp_role %> extension_requests:pp_appenv=<%= \$pp_appenv %>
| EPP

Ec2_instance {
  ensure        => present,
  region        => 'us-west-1',
  image_id      => 'ami-7c280d1c',
  instance_type => 't2.small',
  tags          => {
    puppet_provisioned => 'true',
    development_branch => $::branch,
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
