FROM node:alpine

WORKDIR /app

COPY ./admin .

CMD [ "sh", "-c", "npm install && chmod -R 777 node_modules && npm run serve" ]