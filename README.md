# RNC-TEST-TASK

Follow these steps to run the project locally:

1. **Clone the repository:**

    ```bash
    git clone https://github.com/Bezuro/rnc-test-task.git
    ```

2. **Navigate to the project directory:**

    ```bash
    cd rnc-test-task
    ```

3. **Run Docker Containers:**

    ```bash
    docker-compose up 
    ```

    This command will run the Docker containers defined in the `docker-compose.yml` file and start the application. If you want to rebuild this container locally, you can run

    ```bash
    docker-compose up --build
    ```

4. **Run database migrations:**

    ```bash
    docker exec -it rnc-test-task-laravel-1 php artisan migrate
    ```

    This command will run database migrations using Laravel Sail, which is a Docker development environment for Laravel.

5. **Access the application:**

    Once the containers are up and running, you can access the application by visiting [http://localhost:80](http://localhost:80) in your web browser.

6. **Try upload test.csv**

    You can try application with test.csv file.

7. **Validate:**

    You can validate that data is saved in database via phpMyAdmin by visiting [http://localhost:8080](http://localhost:8080) in your web browser. Credentials: laravel:1337. Table located in laravel/csvdata.
