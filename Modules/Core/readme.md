# Roles and auth

Users of system: SuperAdmin (Администратор), Admin (Контент-Менеджер), Organization, Teacher, User (Student), Parent - DONE
________________
Register available for: Teacher, Organization, User - DONE
________________

# Set of permissions

## Core - DONE
Roles + guard with enabled permissions: list
Permissions (Permissions for each available guard): list

## Roles permissions (global permissions for each role) - DONE
AdminRolePermissions: list, update
OrganizationRolePermissions: list, update
TeacherRolePermissions: list, update
UserRolePermissions: list, update
ParentRolePermissions: list, update

## Users control and per model permissions control (individual permissions for each user)
Admins: list, update, create, delete - DONE
AdminPermissions: list, update - DONE

Organizations: list, update, create, delete - DONE
OrganizationPermissions: list, update - DONE

Teachers: list, update, create, delete - DONE
TeacherPermissions: list, update - DONE

Users: list, update, create, delete - DONE
UserPermissions: list, update - DONE

Parents: list, update, create, delete - DONE
ParentPermissions: list, update - DONE

