# Laravel Asset Management - Entity Relationship Diagram (ERD)

## Database Structure Overview

This document provides a comprehensive Entity Relationship Diagram for the Laravel Asset Management System.

---

## ERD Diagram (Text-Based)

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                    LARAVEL ASSET MANAGEMENT SYSTEM ERD                       │
└─────────────────────────────────────────────────────────────────────────────┘

┌──────────────────────────┐
│      COMPANIES           │
├──────────────────────────┤
│ PK  id                   │
│ FK  user_id              │◄─────┐
│     name                 │      │
│     personal_company     │      │
│     created_at           │      │
│     updated_at           │      │
└──────────────────────────┘      │
         │                        │
         │ 1:N                    │
         │                        │
         ├────────────────────────┼─────────────────────────┐
         │                        │                         │
         │                        │                         │
         ▼                        │                         ▼
┌──────────────────────────┐     │              ┌──────────────────────────┐
│      PROVAIDERS          │     │              │    COMPANY_USER          │
├──────────────────────────┤     │              ├──────────────────────────┤
│ PK  id                   │     │              │ PK  id                   │
│ FK  company_id           │◄────┤              │ FK  company_id           │
│     name                 │     │              │ FK  user_id              │
│     created_at           │     │              │     role                 │
│     updated_at           │     │              │     created_at           │
└──────────────────────────┘     │              │     updated_at           │
         │                        │              └──────────────────────────┘
         │ 1:N                    │                         ▲
         │                        │                         │
         ├────────────────────────┼─────────────────────────┤
         │                        │                         │
         │                        │                         │
         ▼                        │                         │
┌──────────────────────────┐     │              ┌──────────────────────────┐
│   HARDWARE_TYPES         │     │              │        USERS             │
├──────────────────────────┤     │              ├──────────────────────────┤
│ PK  id                   │     │              │ PK  id                   │
│     name                 │     │              │     name                 │
│     slug                 │     │              │     email (unique)       │
│     icon                 │     │              │     email_verified_at    │
│     is_active            │     │              │     password             │
│     sort_order           │     │              │     remember_token       │
│     created_at           │     │              │ FK  current_company_id   │
│     updated_at           │     │              │ FK  current_connected    │
└──────────────────────────┘     │              │         _account_id      │
         │                        │              │     profile_photo_path   │
         │ 1:N                    │              │     created_at           │
         │                        │              │     updated_at           │
         ▼                        │              └──────────────────────────┘
┌──────────────────────────┐     │                         │
│       HARDWARE           │     │                         │ 1:N
├──────────────────────────┤     │                         │
│ PK  id                   │     │                         │
│     make                 │     │              ┌──────────┴───────────────┐
│     model                │     │              │                          │
│     serial               │     │              ▼                          ▼
│     os_name              │     │   ┌──────────────────────────┐  ┌──────────────────────────┐
│     os_version           │     │   │      PERIPHELS           │  │      SOFTWARE            │
│     type                 │     │   ├──────────────────────────┤  ├──────────────────────────┤
│ FK  type_id              │─────┘   │ PK  id                   │  │ PK  id                   │
│     ram                  │         │     make                 │  │     name                 │
│     cpu                  │         │     model                │  │     type                 │
│     status               │         │     serial               │  │     status               │
│     current              │         │     type                 │  │     current              │
│ FK  company_id           │◄────────┤ FK  company_id           │  │     licenses             │
│ FK  user_id              │         │ FK  user_id              │◄─┤ FK  company_id           │
│ FK  provaider_id         │◄────────┤ FK  provaider_id         │  │ FK  provaider_id         │
│     purchased_at         │         │     current              │  │     license_period       │
│     created_at           │         │     purchased_at         │  │     purchased_at         │
│     updated_at           │         │     created_at           │  │     expired_at           │
│     deleted_at           │         │     updated_at           │  │     created_at           │
└──────────────────────────┘         │     deleted_at           │  │     updated_at           │
                                     └──────────────────────────┘  │     deleted_at           │
                                                                   └──────────────────────────┘

┌──────────────────────────┐
│  ACTIVITY_LOG            │
├──────────────────────────┤
│ PK  id                   │
│     log_name             │
│     description          │
│     subject_type         │
│     subject_id           │
│     causer_type          │
│     causer_id            │
│     properties           │
│     event                │
│     batch_uuid           │
│     created_at           │
│     updated_at           │
└──────────────────────────┘

┌──────────────────────────┐
│    NOTIFICATIONS         │
├──────────────────────────┤
│ PK  id (UUID)            │
│     type                 │
│     notifiable_type      │
│     notifiable_id        │
│     data                 │
│     read_at              │
│     created_at           │
│     updated_at           │
└──────────────────────────┘

┌──────────────────────────┐
│  PERSONAL_ACCESS_TOKENS  │
├──────────────────────────┤
│ PK  id                   │
│     tokenable_type       │
│     tokenable_id         │
│     name                 │
│     token (unique)       │
│     abilities            │
│     last_used_at         │
│     expires_at           │
│     created_at           │
│     updated_at           │
└──────────────────────────┘
```

---

## Relationships Summary

### **1. COMPANIES**
- **Has Many** → Provaiders (1:N)
- **Has Many** → Hardware (1:N)
- **Has Many** → Periphels (1:N)
- **Has Many** → Software (1:N)
- **Belongs To** → User (owner)
- **Belongs To Many** → Users (through company_user pivot table)

### **2. USERS**
- **Has Many** → Companies (owned companies)
- **Belongs To Many** → Companies (through company_user pivot table)
- **Has Many** → Hardware (assigned hardware)
- **Has Many** → Periphels (assigned peripherals)
- **Belongs To** → Company (current_company_id)

### **3. PROVAIDERS (Providers)**
- **Belongs To** → Company
- **Has Many** → Hardware (1:N)
- **Has Many** → Periphels (1:N)
- **Has Many** → Software (1:N)

### **4. HARDWARE_TYPES**
- **Has Many** → Hardware (1:N)

### **5. HARDWARE**
- **Belongs To** → Company
- **Belongs To** → User (assigned user)
- **Belongs To** → Provaider
- **Belongs To** → Hardware_Type

### **6. PERIPHELS (Peripherals)**
- **Belongs To** → Company
- **Belongs To** → User (assigned user)
- **Belongs To** → Provaider

### **7. SOFTWARE**
- **Belongs To** → Company
- **Belongs To** → Provaider

---

## Key Foreign Keys & Constraints

| Table | Foreign Key | References | On Delete |
|-------|-------------|------------|-----------|
| companies | user_id | users.id | - |
| provaiders | company_id | companies.id | CASCADE |
| hardware | company_id | companies.id | CASCADE |
| hardware | user_id | users.id | SET NULL |
| hardware | provaider_id | provaiders.id | CASCADE |
| hardware | type_id | hardware_types.id | SET NULL |
| periphels | company_id | companies.id | CASCADE |
| periphels | user_id | users.id | SET NULL |
| periphels | provaider_id | provaiders.id | CASCADE |
| software | company_id | companies.id | CASCADE |
| software | provaider_id | provaiders.id | CASCADE |
| company_user | company_id | companies.id | - |
| company_user | user_id | users.id | - |

---

## Soft Deletes

The following tables support soft deletes (have `deleted_at` timestamp):
- **hardware**
- **periphels**
- **software**

---

## Indexes

### Primary Keys
- All tables have auto-incrementing `id` as primary key

### Foreign Key Indexes
- `companies.user_id`
- `provaiders.company_id`
- `hardware.company_id`, `hardware.user_id`, `hardware.provaider_id`
- `periphels.company_id`, `periphels.user_id`, `periphels.provaider_id`
- `software.company_id`, `software.provaider_id`

### Unique Indexes
- `users.email`
- `hardware_types.name`
- `hardware_types.slug`
- `company_user(company_id, user_id)` - composite unique

---

## Business Rules

1. **Multi-tenancy**: All assets (hardware, peripherals, software) are scoped to companies
2. **Ownership**: Each company has an owner (user_id in companies table)
3. **Assignment**: Hardware and Peripherals can be assigned to users (nullable)
4. **Providers**: All assets must have a provider/supplier
5. **Status Tracking**: Hardware, Peripherals, and Software have status and current flags
6. **Purchase Tracking**: All assets track purchase date, software also tracks expiration
7. **Audit Trail**: Activity log tracks all system changes
8. **Type Management**: Hardware types are managed separately for flexibility

---

## Cardinality Legend

- **1:1** - One to One
- **1:N** - One to Many
- **N:M** - Many to Many (through pivot table)
- **PK** - Primary Key
- **FK** - Foreign Key

---

**Generated:** October 15, 2025
**Version:** 1.0
**System:** Laravel Asset Management
