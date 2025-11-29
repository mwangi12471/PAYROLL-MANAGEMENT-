CREATE DATABASE IF NOT EXISTS payroll_system;
USE payroll_system;

-- Users Table (Employers)
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    subscription_end DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Employees Table
CREATE TABLE employees (
    emp_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    position VARCHAR(100) NOT NULL,
    basic_salary DOUBLE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Deductions Table (Bills, Advances, Breakages)
CREATE TABLE deductions (
    ded_id INT PRIMARY KEY AUTO_INCREMENT,
    emp_id INT NOT NULL,
    description VARCHAR(100) NOT NULL,
    amount DOUBLE NOT NULL,
    date DATE NOT NULL,
    FOREIGN KEY (emp_id) REFERENCES employees(emp_id) ON DELETE CASCADE
);

-- Payroll Transactions Table
CREATE TABLE payroll_transactions (
    payroll_id INT PRIMARY KEY AUTO_INCREMENT,
    emp_id INT NOT NULL,
    basic_salary DOUBLE NOT NULL,
    total_deductions DOUBLE NOT NULL,
    net_salary DOUBLE NOT NULL,
    date DATE NOT NULL,
    FOREIGN KEY (emp_id) REFERENCES employees(emp_id) ON DELETE CASCADE
);

-- Mpesa Transactions Table
CREATE TABLE mpesa_transactions (
    mpesa_id INT PRIMARY KEY AUTO_INCREMENT,
    emp_id INT NOT NULL,
    amount DOUBLE NOT NULL,
    transaction_code VARCHAR(50),
    status VARCHAR(20) NOT NULL,
    date DATE NOT NULL,
    FOREIGN KEY (emp_id) REFERENCES employees(emp_id) ON DELETE CASCADE
);

-- Subscription Payments Table
CREATE TABLE subscription_payments (
    sub_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    amount DOUBLE NOT NULL,
    duration VARCHAR(20) NOT NULL,
    date_paid DATE NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);