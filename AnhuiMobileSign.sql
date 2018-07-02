--user
create table "public"."AM_user"(
    "userid" int4 DEFAULT nextval('aaa_id_seq'::regclass) NOT NULL,
    "mobile" varchar(30) not null,
    "password" varchar(30) not null,
    "userIn.userPasswd" varchar(255) not null,
    "imei" varchar(255) default '',
    "token" varchar(255) default '',
    "imsi" varchar(255) default '',
    "remark" varchar(255) default '',
"createtime" date,
"isDelete" int2 DEFAULT 0,
CONSTRAINT "AM_user_pkey" PRIMARY KEY ("userid")
)
WITH (OIDS=FALSE)
;

ALTER TABLE "public"."AM_user" OWNER TO "postgres";

COMMENT ON COLUMN "public"."AM_user"."userIn.userPasswd" IS '设备加密串';

COMMENT ON COLUMN "public"."AM_user"."token" IS '设备token';

COMMENT ON COLUMN "public"."AM_user"."imei" IS '设备imei';

COMMENT ON COLUMN "public"."AM_user"."imsi" IS '设备imsi';

-- queue
create table "public"."AM_failQueue"(
    "queue_id"  int4 DEFAULT nextval('aaa_id_seq'::regclass) NOT NULL,
    "mobile" varchar(30) not null,
    "userIn.userPasswd" varchar(64) not null,
    "imei" varchar(255) default '',
    "token" varchar(255) default '',
    "imsi" varchar(255) default '',
    "remark" varchar(255) default '',
    "count" int4    default 0,
"createtime" date,
"isDelete" int2 DEFAULT 0,
CONSTRAINT "AM_failQueue_pkey" PRIMARY KEY ("queue_id")
)
WITH (OIDS=FALSE)
;

ALTER TABLE "public"."AM_failQueue" OWNER TO "postgres";

COMMENT ON COLUMN "public"."AM_failQueue"."count" IS '失败计数';
