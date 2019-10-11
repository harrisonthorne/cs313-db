CREATE TABLE IF NOT EXISTS "user" (
    id                  int         PRIMARY KEY,                -- primary key
    keycode             varchar(16) UNIQUE,                     -- unique
    linked              int         REFERENCES user_group (id), -- foreign key (user_group)
    lastHeartbeatCheck  date
);

CREATE TABLE IF NOT EXISTS link_request (
    id          int     PRIMARY KEY,            -- primary key
    sender      int     REFERENCES "user" (id), -- foreign key (user)
    recipient   int     REFERENCES "user" (id), -- foreign key (user)
    status      int,                            -- enum
    send_date   date

    -- enum status
    -- 0    Waiting
    -- 1    Approved
    -- 2    Declined
);

CREATE TABLE IF NOT EXISTS user_group (
    id      int     PRIMARY KEY,    -- primary key
    members int[]                   -- foreign keys (user)
);

CREATE TABLE IF NOT EXISTS heartbeat (
    id          int PRIMARY KEY,            -- primary key
    sender      int REFERENCES "user" (id), -- foreign key (user)
    recipient   int REFERENCES "user" (id), -- foreign key (user)
    count       int,
    send_date   date
);
