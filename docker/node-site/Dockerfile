FROM node:alpine

WORKDIR /app

COPY ./site .

CMD [ "sh", "-c", "npm install && chmod -R 777 node_modules && npm run serve" ]