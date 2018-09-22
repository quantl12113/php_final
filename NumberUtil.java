public class NumberUtil {
    public static boolean checkSquareNumber(int num){
        if(num < 0) return false;
        if(Math.sqrt(num) > (int)Math.sqrt(num)) return false;
        else return true;
    }
    static void checkPerfectNumber(int number){
        int temp = 0;
        for(int i=1;i<=number/2;i++){
            if(number%i == 0){
                temp += i;
            }
        }
        if(temp == number){
            System.out.println("It is a perfect number");
        } else {
            System.out.println("It is not a perfect number");
        }
    }
	public static boolean checkPrimeNumber(int number) {
		int n = (int)Math.sqrt(number);
		for(int i = 2; i <= n; i++) {
			if (number % i == 0) {
				return false;
			}
		}
		return true;
	}
}
