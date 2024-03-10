## 1. Install laravel 10
```
composer create-project laravel/laravel lbs-app
```
## 2. Update .evn file to connect to database
## 3. Run project
```
php artisan serve
```
## 4. Create new table my migration
```
php artisan make:migration create_students_table
```
## 5. Update migration file create_students_table
```
...
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('address');
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }
...
```
## 6. Run migrate
```
php artisan migrate
```
## 7. Create StudentController
```
php artisan make:controller StudentController --api
```
## 8. Create the model
```
php artisan make:model Student
```
## 9. Update model Student
```
...
class Student extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'address',
        'phone'
    ];
    use HasFactory;
}
...
```
## 10.Update route web.php
```
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\StudentController;
Route::get('/', function () {
    return view('welcome');
});
Route::apiResource('/student', StudentController::class);
```
## 11. List the routes
```
php artisan route:list
```
## 12. Update Student Controller
```
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $student;
    public function __contruct(){
        $this->student = new Student();
    }
    public function index()
    {
        return $this->student->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->student->create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->student->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = $this->student->find($id);
        $student->update($request->all());
        return $student;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = $this->student->find($id);
        return $student->delete();
    }
}
```
## 13. # vue-laravel-10-using-vite

## Install canstum
```
composer require laravel/sanctum
```
```
hp artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```
```
php artisan migrate
```
```
php artisan make:controller API/AuthController
```

