import java.io.IOException;
import java.nio.charset.StandardCharsets;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.text.DecimalFormat;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.HashSet;
import java.util.LinkedHashMap;
import java.util.List;
import java.util.Map;
import java.util.Set;
import java.util.TreeMap;

public class FuvarMain {

	public static List<Fuvar> fuvarLista() {
		List<Fuvar> fuvarLista = new ArrayList<>();
		try {
			List<String> beolvas = Files.readAllLines(Paths.get("fuvar.csv"), StandardCharsets.UTF_8);
			for (String sor : beolvas.subList(1, beolvas.size())) {
				String[] split = sor.split(";");

				Fuvar o = new Fuvar(Integer.parseInt(split[0]),
						LocalDateTime.parse(split[1], DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm:ss")),
						Integer.parseInt(split[2]), Double.parseDouble(split[3].replace(",", ".")),
						Double.parseDouble(split[4].replace(",", ".")), Double.parseDouble(split[5].replace(",", ".")),
						split[6]);

				fuvarLista.add(o);
			}
		} catch (IOException e) {
			System.err.println("Hiba a beolvasásnál!");
		}
		return fuvarLista;
	}

	public static void main(String[] args) throws IOException {
		List<Fuvar> fuvar = fuvarLista();
		Map<String, Integer> statisztika = new TreeMap<>();
		Map<LocalDateTime, Fuvar> statisztika2 = new TreeMap<>();
		
		
		 //fuvar.forEach(System.out::println);
		
		/*
		 * for(Fuvar fu : fuvar) { System.out.println(fu);
		 * 
		 * }
		 */

		System.out.println("3. feladat: " + fuvar.size() + " fuvar");

		// 4.feladat
		double bevetel = 0.0;
		int szamlalo = 0;
		double megtettOsszesUt = 0.0;
		Fuvar leghosszabb = null;
		int max = Integer.MIN_VALUE;
		
		for (Fuvar fu : fuvar) {
			if (fu.getTaxi_id() == 6185) {
				bevetel += fu.getViteldij() + fu.getBorravalo();
				szamlalo++;
			}

			// 5. feladat
			statisztika.merge(fu.getFizetes_modja(), 1, Integer::sum);

			// 6.feladat
			megtettOsszesUt += fu.getTavolsag() * 1.6;

			// 7.feladat
			if (fu.getIdotartam() > max) {
				max = fu.getIdotartam();
				leghosszabb = fu;
			}

			// 8.feladat
			if (fu.getIdotartam() > 0 && fu.getViteldij() > 0 && fu.getTavolsag() == 0) {
				statisztika2.put(fu.getIndulas(), fu);
			}

		}

		System.out.println("4. feladat: " + szamlalo + " fuvar alatt: " + bevetel + "$");

		System.out.println("5.feladat: ");

		/*for (Map.Entry<String, Integer> fu : statisztika.entrySet()) {
				
		}*/

		statisztika.forEach((k, v) -> System.out.println("\t" + k + ":" + v));

		System.out.println("6. feladat: " + new DecimalFormat("0.00").format(megtettOsszesUt) + " km");
		System.out.println("7. feladat: Leghosszabb fuvar: ");
		System.out.println("\tFuvar hossza: " + leghosszabb.getIdotartam() + " másodperc");
		System.out.println("\tTaxi azonosító: " + leghosszabb.getTaxi_id());
		System.out.println("\tMegtett távolság: " + leghosszabb.getTavolsag() + " km");
		System.out.println("\tViteldíj: " + leghosszabb.getViteldij() + " $");

		System.out.println("8.feladat: hibak.txt\n");

		String fajlba = "taxi_id;indulas;idotartam;tavolsag;viteldij;borravalo;fizetes_modja\n";

		for (Fuvar fu: statisztika2.values()) {
			
			System.out.println(fu);
			/*fajlba += fu.getTaxi_id() + ";" + fu.getIndulas().format(DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm:ss"))
					+ ";" + fu.getIdotartam() + ";" + fu.getTavolsag() + ";" + fu.getViteldij() + ";"
					+ fu.getBorravalo() + ";" + fu.getFizetes_modja() + "\n";*/
		}

		Files.write(Paths.get("hibak.txt"), fajlba.getBytes());
		
		/*for(Map.Entry<LocalDateTime, Fuvar> s: statisztika2.entrySet()){
			System.out.println(s.g);
			
		}*/
	}

}
