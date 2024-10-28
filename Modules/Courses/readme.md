# Courses GraphQL Module

## Module includes:
- Courses categories CRUD for Admin
- Courses categories list for FrontOffice
- Courses CRUD for Admin
- Courses list for FrontOffice

## Courses categories
- ### Categories can be nested (limit set to 2, but potentially infinite)
    - Web development
        - Frontend
        - Backend
    - Marketing
        - SEO
        - Social media 
      
- ### Data that categories can have
  - name `translatable`
  - slug (auto generated from name)
  - image preview (see [Working with Images](../../README.md#working-with-images))
  - banner image (see [Working with Images](../../README.md#working-with-images))
  - meta title `translatable`
  - meta description `translatable`
  - short description (preview in list) `translatable`
  - description (full description, seo) `translatable`
  - parent category
  - sort order - separated mutation for sorting categories in list

## Courses list
- ### Courses can be created by Admin, Organization and Teachers
- ### Courses that created by Teacher under Organization can be viewed by Admin, Organization and Teacher
- ### Courses that created by Teacher can be viewed by Admin and Teacher
- ### Courses that created by Organization can be viewed by Admin and Organization
- ### Data that courses can have
  - creator `disscuss`
  - owner `disscuss`
  - teacher `disscuss`
  - name `translatable`
  - slug (auto generated from name)
  - meta title `translatable`
  - meta description `translatable`
  - short description (preview in list) `translatable`
  - description (full description, seo) `translatable`
  - category `one to many`
  - image preview (see [Working with Images](../../README.md#working-with-images))
  - banner image (see [Working with Images](../../README.md#working-with-images))
  - skills `many to many`
  - price
  - discount price
  - discount price end date
  - start date
  - end date (after course end date users cant enroll into course, that who already enrolled will have access)
  - access time - how long user will have access to course after enrollment
  - students limit
  - time to complete
  - access type `enum (public, private)` - if private, student can enroll only by invitation
  - teacher `one to many`

### Course Modules
- Modules grouping lessons inside course
- ### Data that modules can have
  - name `translatable`
  - slug (auto generated from name)
  - description `translatable`
  - sort

### Course Lessons
- ### Data that lessons can have
  - name `translatable`
  - slug (auto generated from name)
  - content `translatable`
  - sort
- ### To lessons content can be attached media files, like: images, pdf, video, audio, etc.
