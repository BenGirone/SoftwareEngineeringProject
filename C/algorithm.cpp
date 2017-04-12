/*
Ben Girone.
2/8/17

Algorithms and code designed for the upGrade project
Documentation can be found at https://github.com/BenGirone/SoftwareEngineeringProject/wiki

Contents:
String interpreter
Grading algorithm and equation
*/



#include <iostream> //allow input and output operations
#include <string> //allow use of the string data type
#include <stdlib.h> //allow use of standard library functions
#include <vector> //allow use of the vector data type

using namespace std; //state that the default namespace is being used

//function declaration
vector<double> interpretData(string s);

//beign main function
int main(int argc, char *argsv[])
{
	//receive string data and interpret it
	string data(argsv[1]);
	vector<double> A = interpretData(data);

	//extract the desired grade from the interpreted data
	double x = A[A.size() - 1];				//let x be the desired grade in the course
	A.pop_back(); //remove the last element in A

	//variable declaration
	double W_u = 0;							//let W_u be the sum of all ungraded weights
	double W_g = 0;							//let W_g be the sum of all graded weights
	double p = 0;							//let p be the sum of all points earned
	double c = 0;							//let c be the current grade to date
	double y = 0;							//let y be the average grade needed for ungraded assignments

	//structure the data for the grade calculation
	for (int i = 0; i < (A.size() - 1); i += 2)
	{
		if (A[i] != -1)
		{
			W_g += A[i + 1];
			p += A[i] * A[i + 1];
		}
		else
		{
			W_u += A[i + 1];
		}

	}

	if (W_u != 0)
	{
		//perform the calculation for the grade needed
		y = ((x * (W_u + W_g)) - p) / (W_u);
	}

	if (W_g != 0)
	{
		c = p / W_g;
	}

	//output the calculation result
	cout << y << "_" << c << endl;
} //end main function


  /**
  *	Standard function that will interpret string data and return a vector.
  *
  *	@pre		The string is ordered in the form "_grade1_weight1_grade2_weight2_..._gradeN_weightN_gradeDesired_"
  *	@post		There is a vector that has the values ordered identically to the original string
  *	@param		s the string that is to be interpreted
  *	@return		v a vector that has all the numerical values in s in the same order
  */
vector<double> interpretData(string s)
{
	//variable declaration
	int digits = 0;					//let digits be the number of digits to go backwards
	int dataLength = s.length();	//let dataLength be the be the number of raw elements in the data
	double n = 0;					//let n be a container for interpreted elements
	vector<double> v = {};			//let v be the vector containing all interpreted elements

									//process the data
	for (int i = 0; i < dataLength; i++)
	{
		if (s.at(i) != '_')
		{
			//increase the amount of digits in the element being interpreted
			digits++;
		}
		else
		{
			//extract the element
			n = stod(s.substr((i - digits), i), nullptr);
			digits = 0;
			v.push_back(n);
		}
	}

	//return the result
	return v;
}
/*Pseudo code (interpretData)

Let _s be the string ordered such that "grade1_weight1_grade2_weight2_..._gradeN_weightN_gradeDesired_"
Let _digits = 0
Let _dataLength be the number of characters in _s
Let _n = 0
Let _v be an empty vector

for _i from 0 to _dataLength
if the charcter at position _i in _s != '_'
increment _digits
else
set _n equal to the numerical value within the characters from (_i - _digits) to _i in _s
set _digits to 0
push _n onto the back of _v
*/