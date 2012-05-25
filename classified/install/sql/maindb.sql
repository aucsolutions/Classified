
create table Admins
(
	AdminID int primary key auto_increment,
	AdminEmail varchar(100) unique,
	IsSite_Manage bool default 1,
	IsAd_Manage bool default 1,
	IsAccount_Manage bool default 1,
	IsPayment_Manage bool default 1,
	IsCategory_Manage bool default 1,
	IsPage_Manage bool default 1,
	AdminPassword varchar(50),
	IsEnable bool default 1,
	DateAdded timestamp default now()
	
);

create table MarketingAdManager
(
	MarketingAdID int primary key auto_increment,
	MarketingScript text,
	MarketingPlacing varchar(30)
);

create table Country
(
	CountryID int primary key auto_increment,
	CountryName varchar(200),
	Abbr varchar(200)
);

create table State
(
	StateID int primary key auto_increment,
	StateName varchar(200),
	Abbr varchar(200),
	CountryID int,

	foreign key (CountryID) references Country (CountryID)
);

create table City
(
	CityID int primary key auto_increment,
	CityName varchar(200),
	StateID int,

	foreign key (StateID) references State (StateID)
);

create table Region
(
	RegionID int primary key auto_increment,
	RegionName varchar(100),
	CityID int,

	foreign key (CityID) references City (CityID)
);

create table AccountGroup
(
	AccountGroupID int primary key auto_increment,
	GroupName varchar(100),
	Price decimal(4,2) default 0
);

create table Account
(
	AccountID int primary key auto_increment,
	FullName varchar(50),
	Password varchar(50),
	EmailAddress varchar(100) unique,
	GroupID int,
	Address varchar(200),
	City varchar(200),
	Zip varchar(200),
	Country varchar(200),
	IsEnable bool default 1,

	DateAdded timestamp default now(),
	
	foreign key (GroupID) references AccountGroup(AccountGroupID)
);

create table Category
(
	CategoryID int primary key auto_increment,
	CategoryName varchar(150),
	CategoryDescription varchar(200),
	Price decimal(4,2) default 0,
	OrderNumber int default 0,
	DateAdded timestamp,
	SEOTitle varchar(200),
	SEOKeywords varchar(200),
	SEODescription varchar(500),
	TopBanner varchar(500),
	LeftBanner varchar(500),

	HeadCategoryID int,

	foreign key (HeadCategoryID) references Category (CategoryID)
);

create table Classified
(
	AdID int primary key auto_increment,
	AdTitle varchar(100),
	PriceAlternative enum('1','2','3','4','5'),
	Price decimal(10,2) default 0,
	Description text,
	EmailAddress varchar(200),
	AddressStreet varchar(70),
	AddressCity varchar(70),
	AddressRegion varchar(70),
	AddressZip varchar(10),
	AddressCountry varchar(100),

	GoogleLatitude varchar(50),
	GoogleLongitude varchar(50),
	
	IsOffer bool default 0,
	IsActive bool default 0,
	IsFeatured bool,
	IsPosted bool default 0,
	PaymentStatus enum ( 'UnPaid' , 'Cancelled' , 'Paid' ) default 'UnPaid',

	SearchKeywords text,

	DateAdded timestamp default now(),
	Views int default 0,
	Replies int default 0,
	CategoryStack varchar(100) default null,

	CategoryID int,
	RegionID int,
	AccountID int,

	foreign key (AccountID) references Account (AccountID),
	foreign key (RegionID) references Region (RegionID),
	foreign key (CategoryID) references Category (CategoryID)
);

create table WatchList
(
	AccountID int,
	AdID int,
	foreign key (AdID) references Classified (AdID),
	foreign key (AccountID) references Account (AccountID)
);

create table CategoryExtraField
(
	CategoryExtraFieldID int primary key auto_increment,
	EFName varchar(100),
	FieldType varchar(50),
	DefaultValue varchar(100),
	CategoryID int default null,
	IsRequired bool default 0,
	
	foreign key (CategoryID) references Category (CategoryID)
);

create table AdExtraField
(
	CategoryExtraFieldID int,
	AdExtraFieldValue text,
	AdID int,

	foreign key (AdID) references Classified (AdID)
);

create table PaymentsPlan
(
	PaymentPlanID int primary key auto_increment,
	Amount decimal(5,2),
	DaysToExpire int
);

create table Payments
(
	PaymentID int primary key auto_increment,
	Amount decimal(10,2),
	AdID int,
	
	foreign key (AdID) references Classified (AdID)
);


create table Comments
(
	CommentsID int primary key auto_increment,
	UserName varchar(100),
	EmailAddress varchar(100),
	URL varchar(100),
	UserComments text,
	IsApproved bool,
	DateAdded timestamp default now(),
	
	AdID int,

	foreign key (AdID) references Classified (AdID)

);

create table Messages
(
	Messages int primary key auto_increment,
	Subject varchar(100),
	Body text,
	DateAdded timestamp default now(),

	FromAccountID int,
	ToAccountID int,

	foreign key (FromAccountID) references Account (AccountID),
	foreign key (ToAccountID) references Account (AccountID)
);

create table PageManager
(
	PageManagerID int primary key auto_increment,
	PageName varchar(100),
	PageContents text,
	IncludeFooter bool,
	IncludeHeader bool,
	DateAdded timestamp
);

create table SiteManager
(
	SiteVariable varchar(50) primary key unique,
	SiteValue varchar(500),
	DateAdded timestamp
);

create table SEF_URL
(
	SEF_URL_ID int primary key auto_increment,
	URL varchar(200) unique,
	EntityType varchar(50),
	EntityID int
);

insert into SiteManager( SiteVariable, SiteValue ) values( 'SiteName', 'Your Site Title' );
insert into SiteManager( SiteVariable, SiteValue ) values( 'SiteTitle', 'Your Site Title' );
insert into SiteManager( SiteVariable, SiteValue ) values( 'SiteKeyword', 'Classified' );
insert into SiteManager( SiteVariable, SiteValue ) values( 'SiteDescription', 'Your Site Description' );
insert into SiteManager( SiteVariable, SiteValue ) values( 'CurrentSkin', 'default' );
insert into SiteManager( SiteVariable, SiteValue ) values( 'OwnerEmail', 'youremail@domain.com' );
insert into SiteManager( SiteVariable, SiteValue ) values( 'IsEditorAllow', '0' );
insert into SiteManager( SiteVariable, SiteValue ) values( 'DefaultStatus', '1' );
insert into SiteManager( SiteVariable, SiteValue ) values( 'RSS', '' );
insert into SiteManager( SiteVariable, SiteValue ) values( 'SignupAuthentication', '1' );
insert into SiteManager( SiteVariable, SiteValue ) values( 'GoogleAnalytics', '' );
insert into SiteManager( SiteVariable, SiteValue ) values( 'AccountRequiredToPost', '0' );
insert into SiteManager( SiteVariable, SiteValue ) values( 'DefaultLanguage', 'english.php' );

insert into SiteManager( SiteVariable, SiteValue ) values( 'CurrencySymbol', '$' );

insert into SiteManager( SiteVariable, SiteValue ) values( 'DefaultViewGallery', '1' );
insert into SiteManager( SiteVariable, SiteValue ) values( 'DaysToExpire', '10' );

insert into SiteManager( SiteVariable, SiteValue ) values( 'Notifier', '' );
insert into SiteManager( SiteVariable, SiteValue ) values( 'NotifierTime', '10' );

insert into SiteManager( SiteVariable, SiteValue ) values( 'RecentAdsMainPage', '10' );
insert into SiteManager( SiteVariable, SiteValue ) values( 'RecentAdsMainListingPage', '10' );
insert into SiteManager( SiteVariable, SiteValue ) values( 'SponsoredAdsMainPage', '10' );
insert into SiteManager( SiteVariable, SiteValue ) values( 'SponsoredAdsListingPage', '10' );
insert into SiteManager( SiteVariable, SiteValue ) values( 'MaxListingsPerPage', '10' );

insert into SiteManager( SiteVariable, SiteValue ) values( 'RegistrationEmail', '' );
insert into SiteManager( SiteVariable, SiteValue ) values( 'ADConfirmationEmail', '' );
insert into SiteManager( SiteVariable, SiteValue ) values( 'SendToFriendEmail', 'Hello {Friend_Name} \n Your friend {Sender_Name} wants you to visit {URL} \n He has requested from {Sender_Email} to your email {Friend_Email}' );
insert into SiteManager( SiteVariable, SiteValue ) values( 'DefaultAccountGroup', '' );

insert into SiteManager( SiteVariable, SiteValue ) values( 'PayPalUserName', '' );
insert into SiteManager( SiteVariable, SiteValue ) values( 'PayPalPassword', '' );
insert into SiteManager( SiteVariable, SiteValue ) values( 'PayPalSignature', '' );
insert into SiteManager( SiteVariable, SiteValue ) values( 'PayPalCurrencyCode', '' );

insert into SiteManager( SiteVariable, SiteValue ) values( 'ClassifiedPrice', '0.00' );
insert into SiteManager( SiteVariable, SiteValue ) values( 'PaymentNotes', '' );

insert into SiteManager( SiteVariable, SiteValue ) values( 'GoogleMapKey', '' );

insert into SiteManager( SiteVariable, SiteValue ) values( 'IsSiteClose', '0' );

insert into Admins ( AdminPassword , AdminEmail , IsEnable ) values ( '21232f297a57a5a743894a0e4a801fc3','admin' , 1 );