CREATE TABLE IF NOT EXISTS "public.user" (
    id                  int         PRIMARY KEY, -- primary key
    username            varchar(32) UNIQUE,      -- unique
    keycode             varchar(8)  UNIQUE,      -- unique
    lastHeartbeatCheck  date
);

-- user_group was removed in favor of querying link_request for existing links

CREATE TABLE IF NOT EXISTS "public.link_request" (
    id          int   PRIMARY KEY,                   -- primary key
    sender      int   REFERENCES "public.user" (id), -- foreign key (user)
    recipient   int   REFERENCES "public.user" (id), -- foreign key (user)
    status      int,                                 -- enum
    send_date   date

    -- enum status
    -- 0    Waiting
    -- 1    Approved
    -- 2    Declined
);

CREATE TABLE IF NOT EXISTS "public.heartbeat" (
    id          int  PRIMARY KEY,                   -- primary key
    sender      int  REFERENCES "public.user" (id), -- foreign key (user)
    recipient   int  REFERENCES "public.user" (id), -- foreign key (user)
    count       int,
    send_date   date
);

CREATE SEQUENCE IF NOT EXISTS uuid_seq AS int START WITH 1000;
