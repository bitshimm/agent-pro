FROM node:20.11.0

# Install dependencies
RUN apt update && apt install -y \
    vim \
    zip \
    unzip \
    curl

# Change current user
USER node

EXPOSE 5173

CMD ["sh", "-c", "npm install && npm run dev"]