<?php
    function trim_space_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function calculate(){
        $credits = array();
        $grades = array();
        $sub = array();
            
        for($i=1; $i<=$_SESSION['subjects']; $i++){
            array_push($credits, $_POST['credits'.$i]);
            array_push($grades, $_POST['grades'.$i]);
            array_push($sub, $_POST['sub'.$i]);
        }
        $_SESSION['credits'] = $credits;
        $_SESSION['grades'] = $grades;
        $_SESSION['sub'] = $sub;
        $totalCredits = 0;
        foreach($credits as $val){
            $totalCredits += $val;
        }
        
        $totalGrade = 0;
        
        for($i = 0; $i < count($grades); $i++){
            $totalGrade += ($grades[$i] * $credits[$i]);
        }

        $spi = $totalGrade / $totalCredits;
        return $spi;
    }

    function tableCreate($noOfSub){
        $table = '<table class="table table-responsive">
        <thead><tr >
            <th scope="col">Subject Name</th>
            <th scope="col">Subject Credit</th>
            <th scope="col">Obtained Grade</th>
        </tr> </thead> <tbody>';

        for($i = 1; $i <= $noOfSub; $i++){
            $table .= '
            <tr>
                <th scope="row">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Enter Subject Name" name="sub'.$i.'" value="Subject-'.$i.'" />
                    </div>                    
                </th>
                
                <th scope="row">
                    <div class="form-group">
                        <input type="number" class="form-control" placeholder="Enter Subject Credits" name="credits'.$i.'" value="1" min="0" max="4" />
                    </div>
                </th>
                
                <th>
                    <select name="grades'.$i.'" class="btn btn-secondary dropdown-toggle" id="">
                        <option class="dropdown-item" value="10">A+</option>
                        <option class="dropdown-item" value="9">A</option>
                        <option class="dropdown-item" value="8">B+</option>
                        <option class="dropdown-item" value="7">B</option>
                        <option class="dropdown-item" value="6">C+</option>
                        <option class="dropdown-item" value="5">C</option>
                        <option class="dropdown-item" value="4">D</option>
                        <option class="dropdown-item" value="0">IF</option>
                    </select>
                </th>
            </tr>';
        }
        $table .= "</tbody></table>";
        
    
        $table .= '<div class="text-center">
            <input type="submit" class="btn btn-success" name="calculateSPI" value="Calculate SPI" />
        </div>';

        return $table;
    }

    function createResultTable(){
        $resultTable = 
        '<table class="table-bordered table">
            <tr>
                <td colspan="5"></td>
            </tr>
<tr>
    <td colspan="3">Course Code and Name </td>
    <td>CG</td>
    <td>CE</td>
</tr>
<tbody>';

    // qualified = true means Pass OR false means Fail
    $qualified = null;
    $gr = $_SESSION['grades'];
    $cr = $_SESSION['credits'];
    $sub = $_SESSION['sub'];
    $obtainedGrade = null;
    
    for($i = 0; $i < $_SESSION['subjects']; $i++){ 
        if($gr[$i]==10) $obtainedGrade="A+" ; 
        else if($gr[$i]==9) $obtainedGrade="A" ; 
        else if($gr[$i]==8) $obtainedGrade="B+" ; 
        else if($gr[$i]==7) $obtainedGrade="B" ; 
        else if($gr[$i]==6) $obtainedGrade="C+" ; 
        else if($gr[$i]==5) $obtainedGrade="C" ; 
        else if($gr[$i]==4) $obtainedGrade="D" ; 
        else if($gr[$i]==0) $obtainedGrade="IF" ; 

        if($obtainedGrade === "IF" && $qualified == null ){
            $qualified = 0; 
        } 
        $resultTable .='<tr>
            <td colspan="3">'.$sub[$i].'</td>
        <td>'.$obtainedGrade.'</td>
        <td>'.$cr[$i].'</td>
        </tr>';
    }
        $resultTable .= '
        <tr class="text-center">
            <td colspan="4"></td>
            <td> <b> SPI : '.round($_SESSION['spi'],2).'/10 </b> </td>
        </tr>';
     
        if($qualified === 0){
            $resultTable .= '<tr>
            <td colspan="5" class="text-center error" style="color:red">&#128532; You Failed in Exam. Better Luck Next Time.</td>
        </tr>';
        }else if ($qualified == 0){
            $resultTable .= 
        '<tr>
            <td colspan="5" class="text-center error" style="color:green">  	
            &#129395;You Passed in Exam. Congratulations.  	
            &#127881;
            </td>
            </tr>';
        }
        $resultTable .='</tbody>
                    </table>';
        return $resultTable;
}

 // on Create Button click
 if(isset($_POST['Create'])){
    $subjectCount = $_POST['noOfSubjects'];
    
    if(empty($subjectCount)){
        $noOfSubjectsErr = "Please Select number of subjects";
    }
    // used in select dropdown menu
    $_SESSION['subjects'] = $subjectCount;
    $subjects = $subjectCount;

    $table = tableCreate($subjectCount);

}

// on Calculate button click
if(isset($_POST['calculateSPI'])){
    $SPI = calculate();
    $_SESSION['spi'] = calculate();
    // $SPI = calculate();
}

?>