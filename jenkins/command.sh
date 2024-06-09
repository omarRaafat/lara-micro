#!/bin/bash
sudo docker run --name jenkins-vm  -d  -p 8080:8080 -p 50000:50000 --network jenkins --restart=on-failure -v jenkins_home:/var/jenkins_home jenkins/jenkins:lts-jdk11