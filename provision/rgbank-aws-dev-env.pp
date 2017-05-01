Ec2_instance {
  ensure        => present,
  region        => 'us-west-1',
  image_id      => 'ami-7c280d1c',
  instance_type => 't2.small',
  tags          => {
    puppet_provisioned =>  'true',
  },
}
 
ec2_instance { "rgbank-dev-database":
  user_data => epp('puppet-agent.epp', {
    'master_address' => $puppet_master_address,
    'pp_role'        => 'rgbank-database',
    'pp_appenv'      => $branch,
  }),
}

ec2_instance { "rgbank-dev-web":
  user_data => epp('puppet-agent.epp', {
    'master_address' => $puppet_master_address,
    'pp_role'        => 'rgbank-web',
    'pp_appenv'      => $branch,
  }),
}

ec2_instance { "rgbank-loadbalancer":
  user_data => epp('puppet-agent.epp', {
    'master_address' => $puppet_master_address,
    'pp_role'        => 'rgbank-lb',
    'pp_appenv'      => $branch,
  }),
}
