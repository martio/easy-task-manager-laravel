SELECT 'CREATE DATABASE tasks_testing'
WHERE NOT EXISTS (SELECT FROM pg_database WHERE datname = 'tasks_testing')\gexec
