import java.util.Scanner;

public class Main {

	
	

 public static void main(String[] args) {
		
			
		
		Adattar adattar = new Adattar();
		// Versenyzo v = new Versenyzo("Bela","HUN", 6.77, 5.88, 7.88 );

		System.out.println("2. feladat: " + adattar.getVersenyzokSzama());

		System.out.println(
				"3. feladat: " + (adattar.bejutottEMagyarKurbe() ? "Bejutott" : "Nem jutott be") + "magyar a kűrbe!");

		Scanner scanner = new Scanner(System.in);
		System.out.print("5. feladat: Kérem a versenyző nevét: ");
		String nev = scanner.nextLine();

		if (adattar.letezoVersenyzoE(nev)) {
			System.out.println(nev + " pontszáma: " + adattar.ÖsszPontszám(nev) + " pont.");
		} else {
			System.out.println("5. feladat: Ilyen nevű induló nem volt!");
		}

		System.out.println("7. feladat: ");
		System.out.println(adattar.getStatisztika());

		System.out.println("8.feladat: fájlbaírás");
		try {
			adattar.FajlbaIras();
		} catch (Exception e) {
			e.printStackTrace();
		}

	}

}
