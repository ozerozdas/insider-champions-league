import { Card, CardContent } from "@/Components/ui/card";
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "@/Components/ui/table";
import { Badge } from "@/Components/ui/badge";

export default function LeagueTable({ standings }) {
    return (
        <Card className="w-full max-w-4xl mx-auto mt-8 shadow-xl bg-white dark:bg-gray-800">
            <CardContent className="p-6">
                <h2 className="text-2xl font-bold mb-4">League Standings</h2>
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead className="w-1/12 text-center">#</TableHead>
                            <TableHead>Team</TableHead>
                            <TableHead className="text-center">MP</TableHead>
                            <TableHead className="text-center">W</TableHead>
                            <TableHead className="text-center">D</TableHead>
                            <TableHead className="text-center">L</TableHead>
                            <TableHead className="text-center">GF</TableHead>
                            <TableHead className="text-center">GA</TableHead>
                            <TableHead className="text-center">GD</TableHead>
                            <TableHead className="text-center">Pts</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        {standings.map((team, index) => (
                            <TableRow key={team.team} className="hover:bg-muted/30 transition">
                                <TableCell className="text-center font-bold">{index + 1}</TableCell>
                                <TableCell>
                                    {team.team}
                                </TableCell>
                                <TableCell className="text-center">{team.played}</TableCell>
                                <TableCell className="text-center">{team.won}</TableCell>
                                <TableCell className="text-center">{team.drawn}</TableCell>
                                <TableCell className="text-center">{team.lost}</TableCell>
                                <TableCell className="text-center">{team.gf}</TableCell>
                                <TableCell className="text-center">{team.ga}</TableCell>
                                <TableCell className="text-center">{team.gd}</TableCell>
                                <TableCell className="text-center font-semibold text-primary">
                                    <Badge variant="destructive" className="px-2 py-0.5 text-sm">
                                        {team.points}
                                    </Badge>
                                </TableCell>
                            </TableRow>
                        ))}
                    </TableBody>
                </Table>
            </CardContent>
        </Card>
    );
}