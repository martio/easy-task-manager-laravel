# Easy Task Manager

## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Run `make build` to build fresh images
3. Run `make up` to start the project
4. Open `https://localhost` in your favorite web browser
5. Run `make down` to stop the Docker containers.

## Task Description

Your objective is to create a simple task management system. This system should enable operations such as adding, editing, deleting, and viewing tasks through a REST API interface. Each task in the system should be associated with a specific user and have a status (e.g., "to be done", "in progress", "completed"). An important aspect is also the verification of the ability to manage tasks of a particular user, which should be regulated by appropriate policies. Additionally, it is necessary to prepare a dedicated endpoint for importing user data (by ID) from the website https://dummyapi.io/docs/user and saving it in the system's database.

## Task Solution

Due to the absence of complex business logic, I did not apply the Domain-Driven Design (DDD) approach for this task. Instead, I utilized the CRUD approach.

## Credits

- [Marcin Lewandowski](https://github.com/martio)
