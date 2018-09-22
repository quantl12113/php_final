import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;

public class HelloWorld {
    private String name;
    private int day;
    private int month;
    private int year;
    // Ask the user to enter his/her name adn birthday
    boolean inputData(){
        BufferedReader br = new BufferedReader(new InputStreamReader(System.in));
        try{
            System.out.print("-> Your name: ");
            name = br.readLine();
        } catch (IOException e){
            e.printStackTrace();
            return false;
        }
        System.out.println("-> Your Birthday");
        try{
            System.out.print("  -> Day: ");
            day = Integer.parseInt(br.readLine());
            System.out.print("  -> Month: ");
            month = Integer.parseInt(br.readLine());
            System.out.print("  -> Year: ");
            year = Integer.parseInt(br.readLine());
            return true;
        } catch (NumberFormatException nfe){
            System.err.println("Invalid Format!");
            return false;
        } catch (IOException e){
            e.printStackTrace();
            return false;
        }
    }
}
