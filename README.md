# PHP test

## Pre-requisites
- vagrant installed and setup along with oracle VM

## 1. Installation
- add the following line to hosts file 
    - 192.168.50.10 app.optimy.local
- cd to directory where project is cloned
- vagrant up
- vagrant ssh
- mysql -u root -p phptest < dbdump.sql

---

## Bad Practices in Initial Code

- Following PSR-4 coding standards, the initial code does not have autoloading set-up
- In the initial code, if you need to update method(s) from classes (entity classes and managers), you need to update each class individually (even if the change might probably be the same with classes under same category)
- Each entity has a class with setter and getter methods for each attribute or property of that class. The problem lies when there are new attributes introduced to each class which makes the code for each setter and getter become cluttered in the future
- Usage and declaration of class for the entity managers and entity classes are almost repetitive
- Sensitive information (like db credentials) are clearly visible in code

---

## Improvements Made

- Introduced autoloading and PSR-4 coding standards
- Introduced using of environment variables
- Introduced MVC
    - app/Models folder now holds classes for entities
        - Entity attributes are now settable via $attributes property and setting and getting of attributes has their own centralized methods where you only need to pass the attribute(s) you want to retrieve or set.
    - app/Repositories now holds data-manipulation-logic
        - Did it this way so that model classes only holds data for each entity (makes it like an entity container of sorts)
    - views folder holds UI-logic
    - app/Controllers holds business logic and is accessed via routing (uses nikic/fast-route library)
- Introduced Dependency Injection in controllers and service
- Introduced SOLID Principle - partially
    - Single-responsibility Principle
        - All class methods are now focused on doing one thing
    - Open-closed Principle
        - Models and Repositories uses Interfaces and Abstract classes
        - Specific modifications for each model method can now be done without having to change much in code in the future
        - Same goes for repositories
    - Liskov Substitution Principle
        - objects must be replaceable by instances of their subtypes without altering the correct functioning of the system
        - did this in CrudService so that you only need to pass the correct repository instance, and it still works as intended
    - Interface Segregation Principle (not implemented anymore. I made it simple so that code is more readable, and I think this will just make the code over-engineered)
    - Dependency Inversion Principle
        - somewhat related to Liskov Substitution, but the simple explanation here is that dependency injection should not use a concrete class. It should only use an interface, or an abstract class which will make that class able to use any class that implements or extends that interface or abstract class.
- Introduced Unit Tests
    - given the short time, I was only able to do basic unit tests for models for now
- Introduced log file via htaccess
    - this is just for easy debugging

---

