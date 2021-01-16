use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class C_R_PerPeriod extends Controller
{
    public function homeAbsen()
    {
        return view('V_R_PerPeriod');   
    }
}