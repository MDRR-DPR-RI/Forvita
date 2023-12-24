## Installation

1. Clone the project repository:

   ```sh
   git clone https://github.com/MDRR-DPR-RI/Forvita.git
   ```

3. Install Composer Dependencies:

   ```sh
   composer install   
   ```

3. Copy the Environment File:
   
   ```sh
   cp .env.example .env
   ````
4. Generate Application Key:

   ```sh
   php artisan key:generate
   ```
5. Run Database Migrations and Seed the Databse:
   
   ```sh
   php artisan migrate:fresh --seed
   ```
6. Link Storage:

   ```sh
   php artisan storage:link
   ```

## Configuration

Before running the application, you need to configure the `.env` file.

### Database Configuration

```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=forvita
DB_USERNAME=root
DB_PASSWORD=
```

Replace everything with your actual database credentials.

### Google Login Configuration

```sh
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://your-app-url/auth/google/callback
```

Replace `your_google_client_id` and `your_google_client_secret` with the corresponding values from your Google Cloud Platform (GCP) project. Also, update `http://your-app-url` with the actual URL where your Laravel application is hosted.
 
## Usage

To run the application, use the following commands:

```javascript
php artisan serve
```
