FROM jenkins/jenkins:lts-jdk11
USER root
RUN apt-get update && \
    apt-get install -y --no-install-recommends subversion
USER jenkins
RUN jenkins-plugin-cli --plugins subversion:2.14.0