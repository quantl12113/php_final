public class NumberUtil {
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
