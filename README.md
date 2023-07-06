# Тестовый проект для резюме

Необходимо создать приложение **TODO лист**, по типу **Microsoft ToDo**

В рамках **тестового примера** реализация будет состоять из двух контекстов:

- [ ] Контекст пользователя
- [ ] Контекст заметки

По сути проект идеально ложится на CRUD. Но так как этот проект предназначен исключительно для моего резюме - я применил архитектурные приемы, использование которых для реализации подобных задач излишни.

Цель данного проекта - показать умение работать с:

- DDD
  - [x] Entity
  - [x] ValueObject
  - [x] Aggregate root
  - [x] Bounded context
  - [x] Shared-kernel
- Модульность
  - [x] Разбить на независимые модули (Пользователи, Заметки)
- Layered architecture
  - [x] Domain
  - [x] Application
  - [x] Infrastructure
  - [ ] Anti-Corruption
- Event sourcing
  - [x] Domain events
  - [ ] Event store
  - [ ] Event bus
- CQRS
  - [x] Commands
  - [ ] Queries
  - [ ] Command bus
  - [ ] Query processing
  - [ ] Write model
  - [ ] Read model

Маркерами отмечены те подходы, которые я уже применил в рамках этой работы. По мере работы над этим проектом буду использовать **все** эти концепции. 
