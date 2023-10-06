FROM node:20.8-alpine AS assets-build

WORKDIR /var/www/html
COPY . /var/www/html/

RUN npm install
RUN npm ci
RUN npm run production

FROM nginx:1.25-alpine AS nginx

COPY /resources/ops/docker/nginx/server.conf /etc/nginx/conf.d/default.conf
COPY --from=assets-build /var/www/html/public /var/www/html/
