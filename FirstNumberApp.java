import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;

public class FirstNumberApp {
	private int number;
	
	public FirstNumberApp() {
		while(true) {
			BufferedReader br = new BufferedReader(new InputStreamReader(System.in));
			try {
	            System.out.print("Enter an Integer ");
	            number = Integer.parseInt(br.readLine());
	            break;
	        } catch (NumberFormatException nfe) {
	        	System.err.println("Invalid Format!");
	        } catch (IOException e){
	            e.printStackTrace();
	        }
		}	
	}
	public static void checkNumber(int number){
        if(NumberUtil.checkPrimeNumber(number))
            System.out.println(number+" is prime");
        else
            System.out.println(number+" is composite");
        if(NumberUtil.checkSquareNumber(number))
            System.out.println(number+" is square number");
        else
            System.out.println(number+" is not square number");
        NumberUtil.checkPerfectNumber(number);
    }
}
