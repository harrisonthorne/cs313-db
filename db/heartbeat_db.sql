CREATE TABLE IF NOT EXISTS "public.user_group" (
    id      int     PRIMARY KEY,    -- primary key
    members int[]                   -- foreign keys (user)
);

CREATE TABLE IF NOT EXISTS "public.user" (
    id                  int         PRIMARY KEY,                         -- primary key
    username            varchar(32),
    keycode             varchar(8)  UNIQUE,                              -- unique
    linked              int         REFERENCES "public.user_group" (id), -- foreign key (user_group)
    lastHeartbeatCheck  date
);

CREATE TABLE IF NOT EXISTS "public.link_request" (
    id          int     PRIMARY KEY,                   -- primary key
    sender      int     REFERENCES "public.user" (id), -- foreign key (user)
    recipient   int     REFERENCES "public.user" (id), -- foreign key (user)
    status      int,                                   -- enum
    send_date   date

    -- enum status
    -- 0    Waiting
    -- 1    Approved
    -- 2    Declined
);

CREATE TABLE IF NOT EXISTS "public.heartbeat" (
    id          int PRIMARY KEY,                   -- primary key
    sender      int REFERENCES "public.user" (id), -- foreign key (user)
    recipient   int REFERENCES "public.user" (id), -- foreign key (user)
    count       int,
    send_date   date
);
