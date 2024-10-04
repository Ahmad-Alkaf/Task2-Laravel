create table `users` (
    `id` bigint unsigned not null auto_increment primary key,
    `first_name` varchar(255) not null,
    `last_name` varchar(255) not null,
    `email` varchar(255) not null,
    `email_verified_at` timestamp null,
    `password` varchar(255) not null,
    `birth_date` date not null,
    `gender` varchar(255) not null,
    `remember_token` varchar(100) null,
    `created_at` timestamp null,
    `updated_at` timestamp null
);

alter table
    `users`
add
    unique `users_email_unique`(`email`);

create table `password_reset_tokens` (
    `email` varchar(255) not null,
    `token` varchar(255) not null,
    `created_at` timestamp null,
    primary key (`email`)
);

create table `failed_jobs` (
    `id` bigint unsigned not null auto_increment primary key,
    `uuid` varchar(255) not null,
    `connection` text not null,
    `queue` text not null,
    `payload` longtext not null,
    `exception` longtext not null,
    `failed_at` timestamp not null default CURRENT_TIMESTAMP
);

alter table
    `failed_jobs`
add
    unique `failed_jobs_uuid_unique`(`uuid`);

create table `personal_access_tokens` (
    `id` bigint unsigned not null auto_increment primary key,
    `tokenable_type` varchar(255) not null,
    `tokenable_id` bigint unsigned not null,
    `name` varchar(255) not null,
    `token` varchar(64) not null,
    `abilities` text null,
    `last_used_at` timestamp null,
    `expires_at` timestamp null,
    `created_at` timestamp null,
    `updated_at` timestamp null
);

alter table
    `personal_access_tokens`
add
    index `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`);

alter table
    `personal_access_tokens`
add
    unique `personal_access_tokens_token_unique`(`token`);

create table `projects` (
    `id` bigint unsigned not null auto_increment primary key,
    `name` varchar(255) not null,
    `department` varchar(255) not null,
    `start_date` date not null,
    `end_date` date not null,
    `status` varchar(255) not null,
    `created_at` timestamp null,
    `updated_at` timestamp null
);

create table `timesheets` (
    `id` bigint unsigned not null auto_increment primary key,
    `task_name` varchar(255) not null,
    `date` date not null,
    `hours` decimal(8, 2) not null,
    `project_id` bigint unsigned not null,
    `user_id` bigint unsigned not null,
    `created_at` timestamp null,
    `updated_at` timestamp null
);

alter table
    `timesheets`
add
    constraint `timesheets_project_id_foreign` foreign key (`project_id`) references `projects` (`id`) on delete cascade;

alter table
    `timesheets`
add
    constraint `timesheets_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade;
