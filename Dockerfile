FROM ruby:2.3.1

RUN apt-get update && \
    gem install beaker
