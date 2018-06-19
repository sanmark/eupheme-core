#Start
FROM a2way/dunp:v0.1.0

#Install required packages.
RUN apt-get install -y php-mysql

# Remove default "index.html" file of A2Way DUNP.
WORKDIR /app
RUN rm index.html

# Place boot files.
COPY /boot /app-boot

# Place final file system.
COPY /container-fs-final /

CMD ["bash", "/app-boot/boot.sh"]
