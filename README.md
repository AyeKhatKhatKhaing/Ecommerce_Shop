# Remfly Laravel Developer

The Remfly is the application use to manage their E-commerce services. *More description to follow.*

## Installation

Follow the instructions below to install the app.

### Clone the repo

Run the following command in your terminal:

*Clone with HTTPS*
```
git clone https://gitlab.visibleone.io/Tommy/vo_remfly.git
```

*Clone with SSH*
```
git clone git@gitlab.visibleone.io:Tommy/vo_remfly.git
```

*Note: Prefer to use SSH. Ask your project maintainer if you need to submit your public key.*

### Install dependencies

Laravel use Composer to manage package dependencies. Make sure your development machine has Composer installed.

Go to your project root folder and run the following command:

```
composer install or composer update
```

### Create a local env file

To create a local env file, make a copy from example env file:

```
cp .env.example .env
```

### Generate PHP Key

To create a local env file, make a copy from example env file:

```
php artisan key:generate
```

Then update the config settings for database connection.

### Migrate the database

*Make sure your database connection settings are valid.*

Run the following command to create the database for the app:

```
php artisan migrate
```

After this point the app should be running from your web server. But you will not be able to use the app because there is no user to log in to the app.

### Configure mail

The app uses Mailtrap for local developement. You may need to configure Laravel Mail with your Mailtrap account. To create an account, go to https://mailtrap.io.


### Configure Google Drive

When creating contracts the app uses Google Drive as a place to store documents temporarily before sending them out via SignRequest API. You need to configure your cloud drive configuration as follows:

```
FILESYSTEM_CLOUD=
GOOGLE_DRIVE_CLIENT_ID=
GOOGLE_DRIVE_REFRESH_TOKEN=
GOOGLE_DRIVE_FOLDER_ID=
```

### Configure AWS S3

The app uses AWS S3 to store its documents.

```
AWS_KEY=
AWS_SECRET=
AWS_REGION=ap-southeast-1
AWS_BUCKET=
```

## Contributing

We are going to use pull requests to work on source code. The repo has three long-lived branches: namely main, master, uat. Main branch only for production,
all of these branches are protected to encourage the use of pull request. Only owner and masters can write to it.
Developers are required to sumbit pull requests to master branch.
