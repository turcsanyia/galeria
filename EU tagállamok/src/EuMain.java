import java.io.IOException;
import java.nio.charset.StandardCharsets;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.time.Month;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.Collections;
import java.util.Comparator;
import java.util.List;
import java.util.Map;
import java.util.TreeMap;

public class EuMain {

	public static List<Eu> fajlBeolvas() {
		List<Eu> euLista = new ArrayList<>();

		try {

			List<String> sorok = Files.readAllLines(Paths.get("EUcsatlakozas.txt"), StandardCharsets.UTF_8);
			for (String sor : sorok.subList(0, sorok.size())) {
				String[] split = sor.split(";");

				Eu u = new Eu((split[0]), LocalDate.parse((split[1]), DateTimeFormatter.ofPattern("yyyy.MM.dd")));
				euLista.add(u);

			}

		} catch (IOException ex) {

			System.err.println("Nem sikerült a fájl beolvasása!" + ex);

		}

		return euLista;

	}

	public static <K, V extends Comparable<? super V>> TreeMap<K, V> rendez(Map<K, V> a) {
		TreeMap<K, V> rendezett = new TreeMap<>(new Comparator<K>() {

			@Override
			public int compare(K o1, K o2) {
				int compare = (a.get(o1).compareTo(a.get(o2)));
				if (compare == 0) {
					return 1;
				} else {
					return compare;
				}

			}

		});

		rendezett.putAll(a);
		return rendezett;
	}

	
	public static void main(String[] args) {

		List<Eu> euLista = fajlBeolvas();

		/*
		 * System.out.println("2.feladat: teljlesítve beolvasva!");
		 * 
		 * for (Eu Europa : euLista) {
		 * 
		 * System.out.println(Europa);
		 * 
		 * }
		 */

		int AllamokSzama = euLista.size();
		System.out.println("\n3.feladat: Az Eu tagállamainak száma: " + AllamokSzama + " db");

		String kerdes = "Nem volt májusban csatlakozás!";
		LocalDate csatl = null;
		Eu legkesocsatl = null;
		int Szamlalo = 0;
		LocalDate maxDate = LocalDate.MIN;
		String Orszag = "";

		Map<Integer, Integer> statisztika = new TreeMap<>();

		for (Eu Europa : euLista) {

			if (Europa.getCsatlakozas_eve().getYear() == 2007) {
				Szamlalo++;
			}

			if (Europa.getOrszag_nev().equals("Magyarország")) {
				csatl = Europa.getCsatlakozas_eve();

			}

			if (Europa.getCsatlakozas_eve().getMonth().equals(Month.MAY)) {
				kerdes = "Májusban volt csatlakozás!";

			}

			if (Europa.getCsatlakozas_eve().isAfter(maxDate)) {
				maxDate = Europa.getCsatlakozas_eve();
				legkesocsatl = Europa;
				Orszag = Europa.toString();

			}
			// Ez sem tartozik a feladathoz csak a containsKey értelmezése! ...és a putba
			// tesszük bele nem működik mörgöléssel! :-)
			int szamol = statisztika.containsKey(Europa.getCsatlakozas_eve().getYear())
					? statisztika.get(Europa.getCsatlakozas_eve().getYear())
					: 0;
			statisztika.put(Europa.getCsatlakozas_eve().getYear(), szamol+1);

		}

		System.out.println("4.feladat: " + Szamlalo + " db ország csatlakozott 2007-ben");
		System.out.println("5.feladat: " + csatl);
		System.out.println("6. feladat: " + kerdes);
		System.out.println("7. feladat: " + Orszag);
		System.out.println("Plusz feladat: " + legkesocsatl.getOrszag_nev());
		System.out.println("8. feladat: " + "Statisztika");

		statisztika = rendez(statisztika);
		statisztika.forEach((k, v) -> System.out.println("\t" + k + ": " + v + " orszag"));

		/*
		 * for(Map.Entry<Integer, Integer>Europa : statisztika.entrySet()) {
		 * System.out.println("\t"+ Europa.getKey()+": "+Europa.getValue()+ " orszag");
		 * }
		 */

		// Nem tartozik a feladathoz csak kísérletezem az alábbiak! Innentől kezdve!

		// A maximumkeresés függvénnyel és kulcsokkal!

		/*
		 * int max = (Collections.max(statisztika.values())); for (Integer datum :
		 * statisztika.keySet()) { statisztika.get(datum).equals(max); }
		 * System.out.println("9. feladat: " + max + " vajon kiírja-e?");
		 */

		// 10.feladat
		// A maximumkeresés hagyományosan de kulcsokkal!
		int max2 = Integer.MIN_VALUE;
		int legtobb = 0;

		for (Map.Entry<Integer, Integer> Europa : statisztika.entrySet()) {
			if (Europa.getValue() > max2) {
				max2 = Europa.getValue();
				legtobb = Europa.getKey();

			}
		}
		System.out.println("10. feladat: " + legtobb + ": " + max2);

		// 11. feladat
		System.out.println("11.feladat: ");

		System.out.println("\t" + ((TreeMap<Integer, Integer>) statisztika).lastEntry().getKey() + ": "
				+ ((TreeMap<Integer, Integer>) statisztika).lastEntry().getValue());

		System.out.println("\t" + ((TreeMap<Integer, Integer>) statisztika).firstEntry().getKey() + ": "
				+ ((TreeMap<Integer, Integer>) statisztika).firstEntry().getValue());

	}

}
