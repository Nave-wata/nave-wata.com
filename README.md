# nave-wata.com

A PHP Slim Framework application with Docker and Docker Compose setup.

## Development Environment Setup

### Prerequisites

- Docker
- Docker Compose

### Environment Specifications

- Rocky Linux 8
- PHP 8.2 with Apache
- Composer 2.8
- Slim Framework 4.x
- All required PHP extensions installed

### Getting Started

1. Clone this repository:
   ```
   git clone https://github.com/your-username/nave-wata.com.git
   cd nave-wata.com
   ```

2. Start the development environment:
   ```
   docker-compose up
   ```

3. Install Slim Framework (first time only):
   ```
   docker-compose exec php composer create-project slim/slim-skeleton:4.* .
   ```

4. Access the application:
   - Open your browser and navigate to http://localhost:8080
   - You should see the Slim Framework welcome page

5. Development:
   - The application code is in the `/var/www/html` directory inside the container
   - Any changes to the source code will be reflected in the application
   - Configuration files are in the `docker` directory and mounted as volumes

### Configuration Files

The project uses configuration files stored in the `docker` directory:

- Apache configuration:
  - `docker/apache/httpd.conf`: Main Apache configuration file
  - `docker/apache/15-php.conf`: PHP module configuration for Apache
  - `docker/apache/slim.conf`: Slim Framework specific Apache configuration
  - `docker/apache/00-base.conf`: Base modules configuration (enables rewrite module)

- PHP configuration:
  - `docker/php/php.ini`: PHP configuration file

These files are mounted as volumes in the container, so any changes to them will be reflected in the container without rebuilding the image.

### Commands

- Start the development environment:
  ```
  docker-compose up
  ```

- Start in detached mode:
  ```
  docker-compose up -d
  ```

- Stop the development environment:
  ```
  docker-compose down
  ```

- Rebuild the Docker image:
  ```
  docker-compose build
  ```

- Access the PHP container shell:
  ```
  docker-compose exec php bash
  ```

- Run Composer commands:
  ```
  docker-compose exec php composer [command]
  ```
