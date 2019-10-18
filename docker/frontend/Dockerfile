FROM node:12.10.0

WORKDIR /var/www/symfony

COPY entrypoint.sh /usr/local/bin/entrypoint
ENTRYPOINT ["/usr/local/bin/entrypoint"]

USER node