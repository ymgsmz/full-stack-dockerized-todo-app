## Stage 1 : Build
FROM node:12-alpine AS build-stage

# Change current directory
WORKDIR /tmp/front

# Copy app dependecies as json file
COPY ./app/todo-front/package*.json ./

# Install dependencies
RUN npm install --no-optional

# Copy vue app file in WORKDIR
COPY ./app/todo-front/ .

# Build application
RUN npm run build


## Stage 2 : Run
FROM nginx:1.17-alpine AS production-stage

# Change current directory in current stage
WORKDIR /var/www/html

# Copy built application from build-stage to this stage's WORKDIR
COPY --from=build-stage /tmp/front/dist .

# COPY nginx config file to nginx expected path
COPY ./build/todo-front/conf/nginx.conf /etc/nginx/nginx.conf

