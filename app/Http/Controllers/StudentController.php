<?php
namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();
        if ($request->ajax()) {
            if ($request->has('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }
            if ($request->has('age') && $request->age !== '') {
                    $query->where('age', $request->age);
               }
               Log::info('Query being executed: ', ['query' => $query->toSql(), 'bindings' => $query->getBindings()]);

               $students = $query->get();
               
               Log::info('Students retrieved: ', ['students' => $students]);
               
               return view('student_rows', compact('students'))->render();
           }
   
           $students = Student::all();
           
           return view('index', compact('students'));
       }
   
       public function create()
       {
           return view('create');
       }
   
       public function store(Request $request)
       {
           $request->validate([
               'name' => 'required|string|max:50',
               'age' => 'required|integer|min:1'
           ]);

           Student::create([
               'name' => $request->name,
               'age' => $request->age
           ]);
           return redirect()->route('index')->with('success', 'Student added successfully');   
            }
        public function show(string $id)  
        {
            $student = Student::findOrFail($id);
            return view('show', compact("student"));
        }
        public function edit(string $id)
        {
            $student = Student::findOrFail($id);
            return view('edit', compact("student"));
        }
        public function update(Request $request, string $id)
    {   
        $request->validate([
            'name' => 'required|string|max:50',
            'age' => 'required|integer|min:1'
        ]);
        $student = Student::findOrFail($id);
        $student->update([
            'name' => $request->name,
            'age' => $request->age
        ]);
        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
    

        }

      