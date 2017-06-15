# rgbank-docker-build

This project makes it easy to build Docker images of the RG Bank web
component using the puppetlabs/rgbank module. Since this uses the same Puppet code
that deploys the RG Bank web component, the web component can more easily be migrated
to containers while maintaining the exact same application model.

# Why this is great

Once companies get their infrastructure under control with
Puppet, they end up with a model of their applications and infrastructure. Each
model component is essentially an abstraction above the underlying
implementations for the component (files, packages, firewall rules, etc). This
abstraction and ability to clearly identify different parts of the model makes
it easy to identify where to swap out the underlying infrastructure with better
technology, such as Docker.

# Dependencies

To run, you'll need the
(puppetlabs/image_build)[https://github.com/puppetlabs/puppetlabs-image_build]
module.

The Docker platform will need to be installed on the machine you're building the image on.
Get here: https://www.docker.com/products/overview

Once that is installed, you should have the `puppet docker` subcommand
available.

# Building

To build the RG Bank web component container image, run the following command
form the root of this project:

       puppet docker build

# Running

The `puppet docker build` command results in a new image stored on the local system.
You can see the built images with `docker images list`

This container expects some environment variables to function correctly.

* DB_NAME
* DB_HOST
* DB_USER
* DB_PASSWORD


To run this container, you can run the following command:

        docker run -d -e DB_USER=test -e DB_PASSWORD=test -e DB_NAME=rgbank-database.vm_production-static -e DB_HOST=10.32.167.176 -p 80:80 ccaum/rgbank-web  apachectl -DFOREGROUND

This will connect to to 'rgbank-database.vm_production-static' database on '10.32.167.176' for the Wordpress database.

Navigate to http://localhost to see the RG Bank web application.
